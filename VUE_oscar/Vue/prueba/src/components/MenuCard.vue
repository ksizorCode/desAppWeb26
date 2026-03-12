<script setup>
defineProps({ product: Object });
</script>

<template>
  <div class="card">
    <h2 class="card-title">{{ product.name }}</h2>
    <p class="card-price">${{ product.price }}</p>
    <p class="card-description">{{ product.description }}</p>
  </div>
</template>

<style scoped>
.card {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 1rem;
  box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
  margin-bottom: 1rem;
}
.card-title {
  font-size: 1.2rem;  font-weight: bold;
}
.card-price {
  color: green;  font-weight: bold;
}
.card-description {
  font-size: 0.9rem;  color: #555;
}
</style>

