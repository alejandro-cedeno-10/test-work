<template>
    <div class="main">
        <h5 class="mb-4">Ingreses los nombres y notas de estudiantes para conocer los "buenos"</h5>

        <div v-if="error">
            <span class="text-danger">{{ error }} </span>
        </div>

        <div class="form-notes">
            <div>
                <span>Nombres:</span>
                <input class="form__input" v-model="nombres" type="text" name="nombres"  required/>
            </div>
            <div class="ml-2">
                <span>Nota:</span>
                <input class="form__input__nota" v-model="note" v-on:change="validateNote()" type="number" name="note" required min="1" max="7"/>
            </div>
            <div>
                <button class="button-add"  v-on:click="addNote()">Agregar</button>
            </div>
            <div>
                <button class=" button-add button-calculate"  v-on:click="calculate()">Calcular "buenos"</button>
            </div>
        </div>

        <div class="table mt-3">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Nota</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(objectNote, index) in arrayNote" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td >{{ objectNote.nombres }}</td>
                    <td >{{ objectNote.note }}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</template>
<script>
export default {
    data() {
        return {
            error: false,
            nombres: null,
            note: 0,
            arrayNote:[]

        };
    },
    methods:{
        addNote: function (){
            if(this.note <=0 || this.note >7 ){
                this.error = 'Error: Rango de nota del 1 a 7';
                return ;
            }

            if(!this.nombres){
                this.error = 'Error: escriba los nombres';
                return ;
            }

            this.arrayNote.push({
                'nombres': this.nombres,
                'note': this.note
            });

            this.nombres = null;
            this.note = 0;
            this.error = false;
        },
        validateNote: function (){
           if(this.note <=0 || this.note >7 ){
               this.error = 'Error: Rango de nota del 1 a 7';
           }else{
               this.error = false;
           }
        },
        calculate: function (){
            if(this.arrayNote.length ===0){
                this.error = 'Error: Debe ingresar notas';
            }

            this.$axios.post(`/api/calculate-media-note`, { arrayNote: this.arrayNote })
                .then(response => {
                    if(response) this.$router.push({ path: "/test1-resultados" });
            }).catch(error => {
                if (error.response.status === 405 || error.response.status === 500 ) {
                    this.errorsServidor= 'Ups!, nos encontramos con un error, por favor comunicate con el admin.';
                }
            });

        }
    }
}
</script>
