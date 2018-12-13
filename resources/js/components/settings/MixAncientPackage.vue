<template>

    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        Les paquets de l'ancien sont mélangés.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img class="responsive-img card-image" style="width: 100px;border-radius:5px;" src="/image/card/type/autre-monde.jpg" alt="Autre monde">
                        <img class="responsive-img card-image" style="width: 100px;border-radius:5px;" src="/image/card/type/mythe.jpg" alt="Carte Mythe">
                        <img class="responsive-img card-image" style="width: 100px;border-radius:50%;" src="/image/card/type/PortailBack.jpg" alt="Portail">
                    </div>
                </div>
                <hr>
                <div>
                  <div class="waves-effect waves-light btn" @click="continueAction">Etape suivante</div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data: function(){
            return {
                pageTitle: 'Mélange des paquets de l\'ancien',
            }
        },
        methods: {
            continueAction () {
                // console.log('ici')
                this.$router.push('place-investigators')
            }
        }
    }
</script>

<style>
    img .card-image
    {
        width: 100px;
    }
</style>
