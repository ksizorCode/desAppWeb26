<script setup>

</script>
<template>
<header>
    <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/menu">Menu</RouterLink>
        <RouterLink to="/contacto">Contacto</RouterLink>
    </nav>
</header>
</template>
<style scoped>
header{
    width: 100%;
    height: 10vh;
   
}
nav{
display:flex;
gap:20px;
padding:20px;
background:#42b883;
}

</style>