<script setup>
import TituloContacto from '@/components/TituloContacto.vue';
const mensaje3 = "Contacto";
import Hijo from '@/components/Hijo.vue';
</script>
<template>
<TituloContacto/>
<Hijo :texto="mensaje3"/>

</template>
<style scoped>

</style>