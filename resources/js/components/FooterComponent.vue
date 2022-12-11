<template>
    <footer class="text-sm py-3 mt-6 border-gray-700 bg-white">
        <div class="hidden md:block">
            <div class="container flex justify-between">
                <ul class="flex gap-5">
                    <li v-for="(link, index) in links" :key="index">
                        <span v-if="index === 0">{{link}}</span>
                        <a v-else href="#">{{link}}</a>
                    </li>
                </ul>
                <ul class="flex gap-5">
                    <li v-for="(setting, index) in settings" :key="index">
                        <a href="#">{{setting.text}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container flex flex-col">
            <div class="md:hidden">
                <div class="support">
                    <ul class="pb-3">
                        <li class="py-1" v-for="(support, index) in supports" :key="index"><a href="#">{{support}}</a></li>
                    </ul>
                </div>
                <div>
                    <ul class="settings py-3">
                        <li class="py-1" v-for="(setting, index) in settings" :key="index"><a href="#">{{setting.text}}</a></li>
                    </ul>
                    <ul class="pt-3">
                        <li class="py-1" v-for="(link, index) in links" :key="index"><a href="">{{link}}</a></li>
                    </ul>
                </div> 
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            links: ['© 2022 airbnb', 'Privacy', 'Termini', 'Destinazioni'],
            settings: [
                {
                    text: 'Italiano(IT)',
                    class: ''
                },
                {
                    text: 'EUR',
                    class: ''
                },
                {
                    text: 'Supporto e risorse',
                    class: ''
                },
            ],
            supports: ['Centro Assistenza', 'Accessibilità', 'Segnala un problema', 'Opzioni Cancellazione'],
        }
    }
    
}
</script>

<style lang="scss" scoped>
    footer {
        border-top: 1px solid #C3C6D1;
        
        .support,.settings{
            border-bottom: 1px solid #C3C6D1;
        }
    }
</style>