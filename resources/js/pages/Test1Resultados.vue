<template>
    <div class="main">
        <div class="table-present mt-3 display-flex">
            <div >
            <h5 class="mb-4 ">Media de la clase: {{ media }}</h5>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Calificación</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in arrayNote" :key="index">
                    <th scope="row">{{ index + 1 }}</th>
                    <td >{{ item['nombres'] }}</td>
                    <td >{{ item['note'] }}</td>
                    <td >{{ item['calificacion'] }}</td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="ml-4">
                <button class="button" type="button" v-on:click="routeTest2()">Ejercicio #2</button>
            </div>
        </div>

    </div>

</template>
<script>
export default {
    data(){
        return{
            arrayNote:[],
            media: 0
        };
    },
    mounted() {
        this.fillTable();
        // this.fillDataPieQ2();
    },
    methods:{
        fillTable: function(){
            this.$axios
                .get("/api/calculate-media-note")
                .then((response) => {
                    this.arrayNote = response.data[0];
                    this.media = response.data[1];
                })
                .catch((error) => {
                    if (error) {
                        this.errorsServidor =
                            "Ups!, nos encontramos con un error, por favor comunicate con el admin.";
                    }
                });
        },
        routeTest2: function(){
            this.$router.push({ path: "/test2" });
        }
    },

}
</script>
<style>
.display-flex{
    display: flex;
}
</style>
