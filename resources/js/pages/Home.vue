<template>
    <div class="main">
        <div class="container a-container">
            <div class="form">
                <div >
                    <h2 class="title">Hola!</h2>
                    <p class="description">Eligue a continuación cualquiera de los ejercicios:</p>
                </div>
                <button class="button" type="button" v-on:click="routeTest1()">Ejercicio #1</button>
                <button class="button" type="button" v-on:click="routeTest2()">Ejercicio #2</button>
            </div>

        </div>

        <div class="switch" >
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container">
                <test></test>

            </div>

        </div>
    </div>

</template>
<script>
import test from "../animations/test";
export default {
  components: {test},
    methods:{
        routeTest1: function(){
            this.$router.push({ path: "/test1" });
        },
        routeTest2: function(){
            this.$router.push({ path: "/test2" });
        }
    }
}
</script>
