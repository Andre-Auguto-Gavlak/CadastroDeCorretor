<script setup>
import { ref, onMounted } from "vue";

// VARIAVEIS E VETORES
const alterar = ref(false);
const corretores = ref([]);
const corretorAtual = ref({
  id: null,
  nome: "",
  cpf: "",
  creci: "",
});
const mensagemDeErro = ref(""); // Variável para armazenar a mensagem de erro

//BUSCAR TODOS OS CORRETORES (GET)
const fetchCorretores = () => {
  fetch("http://localhost:8000/api/v1/corretores")
    .then((res) => res.json())
    .then((data) => {
      corretores.value = data.data;
    })
    .catch((error) => console.error("Erro ao carregar corretores:", error));
};

// CADASTRAR UM NOVO CORRETOR (POST)
const storeCorretor = () => {
  fetch("http://localhost:8000/api/v1/corretores", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(corretorAtual.value),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === 422) {
        if (data.errors.nome) {
          mensagemDeErro.value = data.errors.nome[0];
        }
        if (data.errors.cpf) {
          mensagemDeErro.value = data.errors.cpf[0];
        }
        if (data.errors.creci) {
          mensagemDeErro.value = data.errors.creci[0];
        }
      } else {
        mensagemDeErro.value = "";
        fetchCorretores();
        limparFormulario();
      }
    })
    .catch((error) => {
      console.error("Erro ao cadastrar corretor:", error);
    });
};

//  ATUALIZAR UM CORRETOR (PUT)
const updateCorretor = () => {
  fetch(`http://localhost:8000/api/v1/corretores/${corretorAtual.value.id}`, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(corretorAtual.value),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === 422) {
        if (data.errors.nome) {
          mensagemDeErro.value = data.errors.nome[0];
        }
        if (data.errors.cpf_corretor) {
          mensagemDeErro.value = data.errors.cpf[0];
        }
        if (data.errors.creci_corretor) {
          mensagemDeErro.value = data.errors.creci[0];
        }
      } else {
        mensagemDeErro.value = "";
        fetchCorretores();
        alterar.value = false;
        limparFormulario();
      }
    })
    .catch((error) => {
      console.error("Erro ao cadastrar corretor:", error);
    });
};

//EXCLUIR UM CORRETOR (DELETE)
const deleteCorretor = (id) => {
  fetch(`http://localhost:8000/api/v1/corretores/${id}`, {
    method: "DELETE",
  })
    .then(() => {
      fetchCorretores();
    })
    .catch((error) => console.error("Erro ao excluir corretor:", error));
};

//Limpar Formulário v_model
const limparFormulario = () => {
  corretorAtual.value = {
    id: null,
    nome: "",
    cpf: "",
    creci: "",
  };
};

// selecionar corretor
const editarCorretor = (corretor) => {
  corretorAtual.value = { ...corretor };
  alterar.value = true;
};

//Carregar Corretores ao Iniciar
onMounted(fetchCorretores);
</script>

<template>
  <div class="mt-5 centralizar">
    <h1 class="corVerde">Cadastro de Corretores</h1>
  </div>

  <!-- FORMULÁRIO DE CADASTRO / EDIÇÃO -->
  <div
    class="fundoBranco bordaVerde shadow p-3 mt-5 container col-12"
    :class="{ bordaAzul: alterar }"
  >
    <div class="row justify-content-row">
      <div class="mb-3 col-sm-11 col-md-5 col-lg-5">
        <label class="form-label">Nome:</label>
        <input
          v-model="corretorAtual.nome"
          type="text"
          class="form-control"
          placeholder="Informe seu nome:"
        />
      </div>

      <div class="mb-3 col-sm-11 col-md-5 col-lg-5">
        <label class="form-label">CPF:</label>
        <input
          v-model="corretorAtual.cpf"
          type="text"
          class="form-control"
          placeholder="Informe seu CPF:"
        />
      </div>

      <div class="mb-3 col-sm-11 col-md-5 col-lg-5">
        <label class="form-label">CRECI:</label>
        <input
          v-model="corretorAtual.creci"
          type="text"
          class="form-control"
          placeholder="Informe seu CRECI:"
        />
      </div>

      <div class="mt-3 justify-content-center centralizar">
        <button v-if="!alterar" @click="storeCorretor" class="btn btn-lg btn-success">
          Cadastrar
        </button>
        <button v-else @click="updateCorretor" class="btn btn-lg btn-primary">
          Atualizar
        </button>
      </div>
      <div class="centralizar mt-3">
        <label class="fw-bold corVermelho">{{ mensagemDeErro.toLocaleUpperCase() }}</label>
      </div>
    </div>
  </div>

  <!-- TABELA DE CORRETORES -->
  <div class="mt-5 p-3">
    <table class="table shadow">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>CRECI</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="corretor in corretores" :key="corretor.id">
          <th>{{ corretor.id }}</th>
          <td>{{ corretor.nome}}</td>
          <td>{{ corretor.cpf}}</td>
          <td>{{ corretor.creci}}</td>

          <td>
            <a @click="editarCorretor(corretor)" class="bi btnOpcoes m-1 me-2 bi-pen"></a>
            <a
              @click="deleteCorretor(corretor.id)"
              class="bi btnOpcoes m-1 me-2 corVermelho bi-trash3"
            ></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  
</template>
