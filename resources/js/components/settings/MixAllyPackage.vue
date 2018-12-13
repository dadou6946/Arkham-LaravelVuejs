<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>

        <div class="row text-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        On crée la pile des alliés (11 pris au hasard).
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img src="/image/card/type/ally.jpg" alt="Alliés">
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
            pageTitle: 'Récupération des alliés',
            }
        },
        methods: {
            continueAction () {
                // console.log('ici')
                this.$router.push('choose-ancient')
            }
        }
    }
</script>

<style>

</style>
