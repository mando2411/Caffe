from PIL import Image
from collections import Counter
import colorsys
import json
import sys

image_path = sys.argv[1] if len(sys.argv) > 1 else "resources/assets/Menu.png"
img = Image.open(image_path).convert("RGB")
width, height = img.size

# Quantize to stable palette for readable dominant colors
q = img.quantize(colors=24, method=Image.Quantize.MEDIANCUT).convert("RGB")
colors = q.getcolors(width * height) or []
colors = sorted(colors, key=lambda x: x[0], reverse=True)

palette = []
for count, (r, g, b) in colors[:15]:
    hex_code = f"#{r:02X}{g:02X}{b:02X}"
    pct = round((count / (width * height)) * 100, 2)
    h, s, v = colorsys.rgb_to_hsv(r / 255, g / 255, b / 255)
    palette.append({
        "hex": hex_code,
        "rgb": [r, g, b],
        "percent": pct,
        "hsv": [round(h * 360, 1), round(s * 100, 1), round(v * 100, 1)]
    })

# Overall tone estimation
pixels = list(img.getdata())
avg_r = sum(p[0] for p in pixels) / len(pixels)
avg_g = sum(p[1] for p in pixels) / len(pixels)
avg_b = sum(p[2] for p in pixels) / len(pixels)
_, avg_s, avg_v = colorsys.rgb_to_hsv(avg_r / 255, avg_g / 255, avg_b / 255)

result = {
    "file": image_path,
    "dimensions": {"width": width, "height": height, "aspect_ratio": round(width / height, 3)},
    "orientation": "landscape" if width > height else "portrait" if height > width else "square",
    "avg_color": {
        "rgb": [round(avg_r, 1), round(avg_g, 1), round(avg_b, 1)],
        "hex": f"#{int(avg_r):02X}{int(avg_g):02X}{int(avg_b):02X}",
        "avg_saturation_percent": round(avg_s * 100, 1),
        "avg_brightness_percent": round(avg_v * 100, 1)
    },
    "dominant_palette": palette
}

print(json.dumps(result, ensure_ascii=False, indent=2))
