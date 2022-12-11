<template>
    <div>
        <div class="form-input p-6 shadow-md border-0 flex flex-col justify-center items-center gap-4 rounded-xl relative">
            <div  class="flex gallery gap-2">
                <img v-for="(src, i) in files" :key="i" :src="src" :class="[files.length >= 2 ? 'w-1/2': 'w-full' ,' preview-pic object-cover object-center rounded']"  alt="">
            </div>

            <label :for="name" class="rounded-md text-white bg-brand-500 px-6 py-3 cursor-pointer"> {{label}} </label>
            <input v-if="multiple" type="file" ref="img" :name="name" class="input absolute" @change="getFilePath($event)" multiple :id="name">
            <input v-else  type="file" ref="img" :name="name" class="input absolute" @change="getFilePath($event)"  :id="name">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'name', 'multiple'],

        data(){
            return {
                files: [],
            }
        },

        methods:{
            getFilePath($event){
                const {files} = $event.target
                for(let i = 0; i < files.length; i++){
                    const src = URL.createObjectURL(files[i])
                    this.files.push(src)
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .form-input{
        transition: all 300ms ease-in-out ;
        max-height: 400px;
        max-width: 600px;

        .gallery{
            max-width: 600px;
            overflow-x: scroll;
        }

        .preview-pic{
            aspect-ratio: 16/9;
            flex-shrink: 0;
        }

        input{
            opacity: 0;
            z-index: -1;
        }
    }
</style>