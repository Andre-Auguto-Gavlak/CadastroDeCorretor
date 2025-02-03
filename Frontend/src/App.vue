<script setup>
//importa comandos de rota
import { RouterLink, RouterView } from "vue-router";

//importa o bootstrap
import "bootstrap/dist/css/bootstrap.min.css";

//pagina de estilos personalisada
import "./assets/style.css";
</script>

<template>
  <v-app>
    <header>
      
    </header>
    <v-main>
      <body class="fundoCinza">
        
        
        <!-- exibe o index -->
        <div class="container">
          <RouterView />
        </div>

       
      </body>
    </v-main>
  </v-app>
</template>
