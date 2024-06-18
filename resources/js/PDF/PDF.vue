<template>
    <div>
      <h1>Generar PDF con Vue.js</h1>
      <button @click="generatePDF">Generar PDF</button>
      <div id="content" ref="content">
        <h2>Título del Documento</h2>
        <p>Este es el contenido que se incluirá en el PDF.</p>
        <p>Este es otro párrafo de ejemplo para mostrar más contenido.</p>
      </div>
    </div>
  </template>
  
  <script>
  import jsPDF from 'jspdf';
  import html2canvas from 'html2canvas';
  
  export default {
    name: 'GeneratePdf',
    methods: {
      async generatePDF() {
        const content = this.$refs.content;
  
        // Usar html2canvas para capturar el contenido como una imagen
        const canvas = await html2canvas(content);
        const imgData = canvas.toDataURL('image/png');
  
        // Crear un nuevo documento PDF
        const doc = new jsPDF();
  
        // Agregar la imagen al PDF
        const imgProps = doc.getImageProperties(imgData);
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
  
        doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
  
        // Guardar el PDF
        doc.save('ejemplo.pdf');
      }
    }
  }
  </script>
  