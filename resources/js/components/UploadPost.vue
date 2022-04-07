<template>
    <div>
        <li class="nav-item">
                <a class="nav-link" @click.prevent="$modal.show('create-modal')" href="">Create</a>
        </li>  
        <modal name="create-modal" height="auto" > <br>
           <div>  <h5 class="text-center">Create your post</h5> <br>
            <form action="" method="" class="px-3">
               <div class="form-group">
                   <input type="text" class="form-control" placeholder="Title" v-model="form.title">
               </div><br>
               <div class="form-group">
                   <textarea name="description" class="form-control" id="description" v-model="form.description"  cols="30" rows="10" placeholder=""></textarea>
               </div>
               <br>
               <div>
                    <input type="file" class="form-control"  @change="uploadImage">
               </div> <br>
               <div class="text-centar"><button type="button" @click="submitForm()" class="btn btn-primary x-5"> Save </button></div>
               <br><br>
            </form>
           </div>
        </modal>
    </div>
</template>
<script>
export default{
    data(){
        return{
            form : {title: '' , description:'' , img:'' , user_id: window.auth_user},
            image:''
        }
    },
    methods:{
        uploadImage(event){
            
            this.image = event.target.files[0]
        },
        submitForm(){
            const fd = new FormData();
            fd.append(  "image" , this.image  ,  this.image.name);
            // console.log(fd);
            // this.form.img = fd
            axios.post("/upload-image" , fd).then(({data}) => {
                this.form.img = "/storage/"+data.data ;
                axios.post("/upload-post" ,    this.form ).then(({data}) =>{
                   this.$fire({
                            title: "Success",
                            text: "success created post",
                            type: "success",
                            timer: 2000
                        }).then(r => {
                        
                            this.$modal.hide('create-modal');
                   });
            });

            console.log(data);

            });
            
        }
    },
    created(){
        
    }
}
</script>
<style scoped>
</style>