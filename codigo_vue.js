var url="bd/crud.php";
new Vue({
    el:'#app',
    vuetify: new Vuetify(),
    data:()=>({
        search:'',
        snackbar:false,
        textSnack:'texto del snackbar',
        dialog: false,
        headers: [
            {
                text:'ID',
                align:'left',
                sorteable:false,
                value:'id'
            },
            {
                text:'MARCA',
                align:'left',
                sorteable:true,
                value:'marca'
            },
            {
                text:'MODELO',
                align:'left',
                sorteable:true,
                value:'modelo'
            },
            {
                text:'STOCK',
                align:'right',
                sorteable:false,
                value:'stock'
            },
            {
                text:'ACCIONES',
                align:'right',
                sorteable:false,
                value:'accion'
            }
        ],
        moviles:[],
        editedIndex:-1,
        editado:{
            id:'',
            marca:'',
            modelo:'',
            stock:''
        },
        defaultItem:{
            id:'',
            marca:'',
            modelo:'',
            stock:''
        }
    }),

    computed:{
        formTitle(){
            return this.editedIndex === -1 ? 'Nuevo Registro' : 'Editar registro'
        }
    },
    watch:{
        dialog(val){
            val || this.cancelar()
        }
    },
    created(){
        this.listarMoviles();
        console.log('dentro de created');
    },
    methods:{
        listarMoviles:function(){
            //fetch(url,{opcion:4}).then(response=>{
            axios.post(url,{opcion:4}).then(response=>{
                this.moviles=response.data;
                console.log("moviles:"+this.moviles);
            });
        },
        altaMovil:function(){
            axios.post(url,{opcion:1, marca:this.marca, modelo:this.modelo, stock:this.stock}).then(response=>{
                this.listarMoviles();
            });
            this.marca="",
            this.modelo="",
            this.stock=0
        },
        editarMovil:function(id, marca, modelo,stock){
            axios.post(url,{opcion:2, id:id, marca:marca, modelo:modelo, stock:stock}).then(response=>{
                this.listarMoviles();
            });
        },
        borrarMovil:function(id){
            axios.post(url,{opcion:3, id:id}).then(response=>{
                this.listarMoviles();
            });
        },

        editar(item){
            this.editedIndex=this.moviles.indexOf(item)
            this.editado=Object.assign({},item)
            this.dialog=true
        },
        borrar(item){
            const index=this.moviles.indexOf(item)
            var r=confirm("¿Esta seguro de eliminar el registro?");
            if(r==true){
                this.borrarMovil(this.moviles[index].id)
                this.snackbar=true
                this.textSnack='Se elimino el registro'
            }else{
                this.snackbar=true
                this.textSnack='operacion cancelada'
            }

        },
        cancelar(){
            this.dialog=false
            this.editado=Object.assign({},this.defaultItem)
            this.editedIndex=-1
        },
        guardar(){
            if(this.editedIndex > -1){
                this.id=this.editado.id
                this.marca=this.editado.marca
                this.modelo=this.editado.modelo
                this.stock=this.editado.stock
                this.snackbar=true
                this.textSnack='Actualizacion exitosa'
                this.editarMovil(this.id, this.marca, this.modelo, this.stock)
            }else{
                if(this.editado.marca=="" || this.editado.modelo=="" || this.editado.stock==0){
                    this.snackbar=true
                    this.textSnack='datos incompletos'
                }else{
                    this.marca=this.editado.marca
                    this.modelo=this.editado.modelo
                    this.stock=this.editado.stock
                    this.snackbar=true
                    this.textSnack='Alta exitosa'
                    this.altaMovil()
                }
                
            }
            this.cancelar()
        }
        
    },



});