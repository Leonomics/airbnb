<template>
    <div class="static rounded overflow-hidden">
        <div>
            <button class="p-1 sponsor font-semibold" @click="showPlans()">
                Promuovi ora
            </button>
        </div>
        <div  v-if="planPopUpVisible">
            <sponsor-component @show-plans="showPlans"  :apartment="apartment" />
        </div>
    </div>
</template>

<script>
export default {
    props:[
        "apartment"
    ],
    data(){
        return{
            planPopUpVisible: false,
        }
    },

    methods:{
        showPlans(){
            this.planPopUpVisible = !this.planPopUpVisible
        },
    }
}
</script>

<style lang="scss" scoped>
    // .sponsor{
    //     background-color: #F5DF19;
    // }
</style>