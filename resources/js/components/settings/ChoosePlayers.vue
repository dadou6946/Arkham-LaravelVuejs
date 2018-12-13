<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group text-center">
                  <label for="">Nombre de joueurs</label>
                  <div>
                    <div class="btn btn-primary" @click="down" :disabled="playerNumber==1">-</div>
                    <div class="btn btn-default">{{playerNumber}}</div>
                    <div class="btn btn-success" @click="up" :disabled="playerNumber>5">+</div>
                  </div>
                </div>

                <hr>
            </div>

            <div class="col-md-9">

                <div class="form-group text-center">
                  <div v-for="(player, index) of players">
                    <label>Joueur {{index + 1}}</label>
                    <input type="text" class="form-control" v-model="player.name">
                  </div>
                </div>

                <hr>

                <div class="form-group">
                  <input type="submit" class="form-control btn btn-success" @click="submit" :disabled="!allowConfirm" value="Confirmer">
                </div>

                <!--<div v-if="keptData!=''">{{keptData}}</div>-->

            </div>

        </div>


    </div>
</template>

<script>

    import axios from 'axios';
    export default {
        data: function(){
            return {
                pageTitle: 'Choix des joueurs',
                playerNumber: 1,
                allowConfirm: false,
                players: [
                    {
                        name : '',
                    }
                ],
                keptData: ""
            }
        },
        methods: {
            up () {
                if(this.playerNumber < 6)
                {
                    this.playerNumber++
                    this.players.push({ name : ''})
                    this.allowConfirm = false
                }
            },
            down () {
                if(this.playerNumber !=1)
                {
                    this.playerNumber--
                    this.players.splice(this.playerNumber, 1)
                }
            },

            submit () {
                //Envoi des données au server
                //Diriger vers le nouveau composant
                self = this;
                //Exemple de requete avec axios
                axios.get('https://api.themoviedb.org/3/movie/550?api_key=cbf431d660a6bb41316b07a07bbd9da6')
                  .then(function (response) {
                    // handle success
                    self.keptData = response.data.original_title
                    console.log(self.keptData);
                    // Redirige vers home ou prochain composant
                    self.$router.push('/choose-characters')
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .then(function () {
                    // always executed
                  });
            }


        }
        ,
        updated(){
            let cpt = 0
            this.players.forEach((player)=>{
                if(player.name=='') cpt++
            })
            if(cpt == 0) this.allowConfirm = true
        },
    }
</script>

<style>
        .btn {
            border-radius: 5px;
            margin: 2px;
            /*color: white;
            background-color: teal;*/
        }
        .selected {
            border: 3px solid lightgreen;
            -webkit-box-shadow: -3px -2px 5px 0px lightgreen;
            -moz-box-shadow: -3px -2px 5px 0px lightgreen;
            box-shadow: -3px -2px 5px 0px lightgreen;        }

</style>
