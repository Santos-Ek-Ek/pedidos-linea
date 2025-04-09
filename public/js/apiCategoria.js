var apiCat= "http://localhost/ecommerce-App/public/apiCat";


new Vue({

    el:'#categoria',
    data:{
        categoria:[],
    },
    created:function(){
        this.obtenerCat();
    },
    methods:{
        obtenerCat:function(){
            this.$http.get(apiCat).then(function(json){
                this.categoria=json.data;
            }).catch(function(json){
                console.log(json);
            });
        },
    }
});