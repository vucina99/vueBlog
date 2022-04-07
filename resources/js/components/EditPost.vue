<template>
<section>
    
        <a @click.prevent="openEditModalData()" href="#">  <i class="fas fa-pen" style="cursor:pointer"></i></a>
        <modal :name="`editModal-${this.data.id}`" height="auto" @before-open="beforeOpen">
            <div> <br> <h5 class="text-center">Edit your post</h5> <br>
            <form action="" method="" class="px-3">
               <div class="form-group">
                   <input type="text" class="form-control" placeholder="Title" v-model="form.title">
               </div><br>
               <div class="form-group">
                   <textarea name="description" class="form-control" id="description" v-model="form.description"  cols="30" rows="10" placeholder=""></textarea>
               </div>
               <br>
               <div class="text-centar"><button type="button" @click="submitForm()" class="btn btn-primary x-5"> Save </button></div>
               <br><br>
            </form>
            </div>
        </modal>
        </section>
</template>
<script>
export default{
    props: ['data' ],
    data(){
        return{
            form : {}
        }
    },
    methods:{
        openEditModalData(){
            this.$modal.show(`editModal-${this.data.id}`);
        },
        beforeOpen(){
              console.log(this.data);
        },
        submitForm(){
            axios.post("/update-post" , this.form).then(({data}) => {
            if(data.status){
            this.$fire({
                title: "Success",
                text: "this post has been updated",
                type: "success",
                timer: 2000
                }).then(r => {
                   
                    this.$modal.hide(`editModal-${this.data.id}`);
                });
            } else{
                 this.$fire({
                title: "Error",
                text: "something is wrong",
                type: "error",
                timer: 2000
                });
            }
           }).catch((error) =>{
                console.log(error);
            })
            
        }
    },

    created(){
      this.form = this.data;
      console.log(this.form);
    }
}
</script>
<style scoped>
</style>