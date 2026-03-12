<script setup>
import TituloMenu from '@/components/TituloMenu.vue';
import Hijo from "@/components/Hijo.vue";
import MenuCard from '@/components/MenuCard.vue';
import menu from '../data/menu.json'
const mensaje2 = "Menu"
</script>
<template>
<TituloMenu/>
<Hijo :texto="mensaje2" />

  <div class="menu-container">  
  <MenuCard v-for="product in menu" 
  :key="product.id" 
  :product="product"    />  
  </div>

</template>
<style scoped>
.menu-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
}
</style>