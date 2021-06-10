<template>
   <div>
      <img :src="this.previewImage" class="uploading-image" />
      <input type="file" accept="image/jpeg" @change=uploadImage>
   </div>
</template>

<script>
    export default {
        name:'imageUpload',
        data(){
            return{
               previewImage:null
            }
        },
        methods:{
            uploadImage(e){
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.previewImage = e.target.result;
                    console.log(this.previewImage);
                };
            }
        }
     }  // missing closure added
</script>



<style>
   .uploading-image{
     display:flex;
   }
 </style>