import { createWorker } from 'tesseract.js';

(async () => {
  const imagePath = process.argv[2] || 'resources/assets/Menu.png';
  const worker = await createWorker('eng');
  const { data } = await worker.recognize(imagePath);
  console.log(data.text || '');
  await worker.terminate();
})();
