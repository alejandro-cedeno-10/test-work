<template>
    <div class="main">
        <h5 class="mb-4">Ingrese los numeros separados de ", "</h5>
        <h5 class="mb-4"> Como el siguiente ejemplo, separado con ", " incluido el espacio:</h5>


        <div class="form-notes">
            <div>
                <span>Numeros para el array:</span>
                <input class="form__input" v-model="exampleNumber" type="text" name="exampleNumber"  value="exampleNumber" required/>
            </div>
            <div>
                <button class=" button-add button-calculate"  v-on:click="calculate()">Contar numeros</button>
            </div>
            <div>
                <button class=" button-add button-calculate"  v-on:click="routeInit()">Ir a inicio</button>
            </div>

        </div>

        <div class="request mt-4" v-if="showNumber">
            <span class="mt-2">
                El total de numero repetidos es {{ countRepeat  }}
            </span>
            <span class="mt-2" v-for="(numberRepeat, number) in arrayNumber" :key="number">
                El numero {{number}}, se repite {{numberRepeat}} veces.
            </span>
        </div>


    </div>

</template>
<script>
export default {
    data() {
        return {
            exampleNumber:'1, 2, 3, 2, 5, 5, 2, 7, 5, 2, 5, 2',
            showNumber: false,
            arrayNumber: [],
            countRepeat: 0
        };
    },
    methods:{
        calculate: function (){

            this.$axios.post(`/api/number-repetidos`, { numbers: this.exampleNumber })
                .then(response => {
                    if(response) {
                        this.showNumber = true;
                        this.arrayNumber = response.data[0]
                        this.countRepeat = response.data[1]
                    }
            }).catch(error => {
                if (error.response.status === 405 || error.response.status === 500 ) {
                    this.errorsServidor= 'Ups!, nos encontramos con un error, por favor comunicate con el admin.';
                }
            });

        },
        routeInit: function (){
            this.$router.push({ path: "/" });
        }
    }
}
</script>
<style>
.request {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    flex-direction: column;
}
</style>
