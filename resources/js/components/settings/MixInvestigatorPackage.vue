<template>

    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        Les paquets investigateur sont mélangés.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <img src="/image/card/type/ally.jpg" alt="Alliés">
                        <img src="/image/card/type/spell.jpg" alt="Sorts">
                        <img src="/image/card/type/common.jpg" alt="Objets communs">
                        <img src="/image/card/type/unique.jpg" alt="Objets uniques">
                        <img src="/image/card/type/skill.jpg" alt="Compétences">
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
                pageTitle: 'Mélange des paquets investigateur',
            }
        },
        methods: {
            continueAction () {
                // console.log('ici')
                this.$router.push('set-random-objects')
            }
        }
    }
</script>

<style>

</style>
