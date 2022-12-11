<template>
    <header>
        <div class="container">
            <div class="flex items-center h-20">
                <a href="/" class="text-brand-500 text-xl">airbnb</a>
                <nav class="ml-auto">
                    <div>
                        <template v-if="user">
                            <a href="/admin/apartments" class="no-underline hover:underline mr-6">I miei appartamenti</a>
                            <a @click="logout" href="#" class="no-underline hover:underline">Logout</a>                            
                        </template>
                        <template v-else>
                            <a href="/login" class="no-underline hover:underline mr-6">Login</a>
                            <a href="/register" class="no-underline hover:underline">Register</a>
                        </template>                       
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            user: this.$root.user,
            baseUrl: window.location.origin
        }
    },
    methods: {
        logout() {
            const path = this.$route.path
            axios.post('/logout').then(res => {
                window.location.href = path
            })
        },
    },
}
</script>

<style lang="scss" scoped>

</style>