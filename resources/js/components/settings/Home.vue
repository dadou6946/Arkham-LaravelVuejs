<template>
    <div class="container">

        <h1 class="center-align">{{ pageTitle }}</h1>

        <div class="divider"></div><br>

        <div class="row">
            <div class="col-md-12">

                <div class="center-align">
                  <router-link :to="{ path: '/choose-players' }" class="waves-effect waves-light btn">Nouvelle partie</router-link>
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
        }
    }
</script>
