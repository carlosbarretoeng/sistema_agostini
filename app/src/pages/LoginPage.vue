<template>
  <div class="fullscreen flex justify-center items-center bg-primary">
    <q-card style="width: 300px;">
      <q-card-section>
        <q-form
          @submit="onSubmit"
          class="q-gutter-md"
        >
          <q-input
            filled
            v-model="username"
            label="Username *"
          />

          <q-input
            filled
            type="password"
            v-model="password"
            label="Password *"
          />

          <div>
            <q-btn label="Log In" type="submit" color="primary" class="full-width q-mb-md"/>
            <q-btn label="I forgot my password" color="primary" flat class="full-width" />
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</template>

<script lang="ts">
import { useRouter } from 'vue-router';
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'LoginPage',
  setup () {
    const router = useRouter();
    return {
      username: ref(null),
      password: ref(null),
      onSubmit: () => {
        router.push('/app/');
      }
    };
  }
});
</script>
