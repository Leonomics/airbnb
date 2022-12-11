<template>
    <div class="search-box flex items-center rounded-full border-gray-700 border-2">
        <i class="fa-solid fa-magnifying-glass text-xl text-gray-700"></i>
        <input class="w-full mx-3 text-base text-gray-700 font-bold" type="text" placeholder="Cerca un appartamento...">
        <i class="fa-solid fa-circle-xmark text-xl text-gray-300 hover:text-brand-300"></i>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.search-box {
    padding: 1.125rem 1.5rem;
}

input::placeholder {
    color: #C3C6D1;
    font-weight: 400;
}
</style>