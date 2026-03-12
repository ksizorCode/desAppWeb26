<script setup>
import TituloHome from '@/components/TituloHome.vue';
import Hijo from "@/components/Hijo.vue";
const mensaje1 = "Home";


</script>
<template>
<TituloHome/>
<Hijo :texto="mensaje1" />


</template>
<style scoped>

</style>