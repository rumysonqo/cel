<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <v-app id="app">
        <v-data-table :headers="headers" :items="moviles" :search="search" class="elevation-3">
            <template v-slot:top>
                <v-system-bar color="indigo darken-2"></v-system-bar>
                <v-toolbar color="indigo">
                    <v-btn class="mx-2" :elevation="10" fab dark color="teal accent-4" @click="dialog=true"> <v-icon dark>mdi-plus</v-icon> </v-btn>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-toolbar-title class="white--text">KITS 2022</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="500px">
                      <template v-slot:activator="{on}"></template>
                      <v-card>
                        <v-card-title class="cyan white--text">
                          <span class="headline">{{formTitle}}</span>
                        </v-card-title>
                        <v-card-text>
                          <v-container>
                            <v-row>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.marca" label="Marca"></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.modelo" label="Modelo"></v-text-field>
                              </v-col>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.stock" type="number" step="1" min="0" label="Stock"></v-text-field>
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue-grey" class="ma-2 white--text" @click="cancelar">Cancelar</v-btn>
                          <v-btn color="teal accent-4" class="ma-2 white--text" @click="guardar">Guardar</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                </v-toolbar>
                <v-col cols="12" sm="12">
                  <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details>
                  </v-text-field>
                </v-col>
            </template>

            <template v-slot:item.accion="{item}">
              <v-btn class="mr-2" fab dark small color="cyan" @click="editar(item)">
                <v-icon dark>mdi-pencil</v-icon>
              </v-btn>
              <v-btn class="mr-2" fab dark small color="error" @click="borrar(item)">
                <v-icon dark>mdi-delete</v-icon>
              </v-btn>
            </template>


        </v-data-table>
        <template>
          <div class="text-center ma-2">
            <v-snackbar v-model="snackbar">
              {{textSnack}}
              <v-btn color="info" text @click="snackbar=false">Cerrar</v-btn>
            </v-snackbar>
          </div>
        </template>


    </v-app>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="codigo_vue.js"></script>

</body>
</html>