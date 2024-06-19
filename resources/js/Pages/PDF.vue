<template>
    <div>
      <h1>Generar PDF con Vue.js</h1>
      <button @click="generatePDF">Generar PDF</button>
        <div id="content" ref="content" style="max-width: 100%; margin: 1rem">
          <el-table :data="profesores" max-height="800" border>
              <el-table-column prop="nombre" label="Nombre" width="90"/>
              <el-table-column label="Asignaturas">
                  <template #default="scope">
                      <el-table :data="scope.row.asignaturas" border>
                          <el-table-column prop="asignatura" label="Asignatura"></el-table-column>
                          <el-table-column prop="curso" label="Curso"></el-table-column>
                          <el-table-column prop="horas" label="Horas"></el-table-column>
                      </el-table>
                  </template>
              </el-table-column>
              <el-table-column prop="reduccion" label="Reducción por cargo" width="120" align="center"/>
              <el-table-column prop="horasTotales" label="Total Horas" width="90" align="center"/>
          </el-table>
      </div>

    </div>
  </template>

<script setup>
const props = defineProps({
    profesores: Array,
    asignaturas: Object,
    cursos: Array
});
</script>
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
        doc.save('horario.pdf');
      }
    }
  }
  </script>
