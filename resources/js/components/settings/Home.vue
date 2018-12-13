<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-12">

                <div class="form-group text-center">
                  <router-link :to="{ path: '/choose-players' }" class="waves-effect waves-light btn" @click="submit">Nouvelle partie</router-link>
                  <div class="waves-effect waves-light btn" @click="submit">Continuer une partie</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                pageTitle: 'Accueil'
            }
        },
        methods: {
            submit () {
                //Diriger vers le nouveau composant
                console.log('début')
            },
        }
    }
</script>
