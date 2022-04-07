<template>
    <div class="container">
    <div v-for="(post, index) in posts" :key="index">
     <div class="card text-center">
        <div class="card-header">
               
            {{post.user.name}}
            
        </div>
        <div class="card-body">
            <div v-if="post.img != null">
            <img :src="post.img" class="w-100"/>
            </div>
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{post.description | str_limit(50)}}</p>
            <div class="d-flex justify-content-center">
            <div><a :href="'full-post/'+ post.id" class="btn btn-primary">See more</a> &nbsp; &nbsp;</div>
            <div class="pt-2" v-if="auth_check && auth_user.id == post.user_id "><edit-post  :data="post" ></edit-post> &nbsp;&nbsp;</div>
             <div class="pt-2" v-if="auth_check && auth_user.id == post.user_id " > &nbsp;&nbsp; <a href="" @click.prevent="deletePost(post.id)"><i class="fa fa-trash text-danger"></i></a>  &nbsp;&nbsp;</div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <vue-moments-ago prefix="posted" suffix="ago" :date="post.created_at"></vue-moments-ago>
           
        </div>
        </div> 
        <br>
        </div>

        <nav aria-label="Page navigation example" v-if="posts.length > 0">
            <ul class="pagination">
                <li  @click="getData(paginateNumber-1)" v-bind:class="[paginateNumber  <= 0 ? 'disabled' : '', 'page-item']"> 
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li   v-for="(n , index) in paginate" :key="index" v-bind:class="[paginateNumber  == n-1  ? 'active' : '', 'page-item']"     @click="getData(n-1)"><a class="page-link" href="#">{{n}}</a></li>
               
                <li  @click="getData(paginateNumber+1)"  v-bind:class="[paginateNumber  >= paginate -1  ? 'disabled' : '', 'page-item']">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
import VueMomentsAgo from 'vue-moments-ago'
export default{
    components: {
        VueMomentsAgo
    },
    data(){
        return{
            posts: false,
            paginate :1,
            paginateNumber : 0,
            activeObj : '',
        }
    },
    methods:{
      getData(page = 0){
          if(page >= 0 && page < this.paginate){
        axios.get("/posts/"+page).then(({data}) =>{
            this.posts = data.data;
            this.paginate = data.count;
            this.paginateNumber = page;
            
        }).catch((err) =>{
            console.log(err);
        });
        }},
        deletePost(id){
            this.$confirm("Are you sure?").then(() => {
                axios.post("/delete-post" , {"id" : id}).then(({data}) => {
                    this.$fire({
                        title: "Success",
                        text: "Success delete",
                        type: "success",
                        timer: 2000
                    }).then(({data}) =>{
                        this.getData();
                    }); 
                });
            });
            
        }
       
    },
    filters : {
         str_limit(value, size) {
            if (!value) return '';
            value = value.toString();
        
            if (value.length <= size) {
            return value;
            }
            return value.substr(0, size) + '...';
        }
    },
    created(){
      this.getData();
    }
}
</script>
<style scoped>
</style>