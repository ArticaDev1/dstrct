import { computed, reactive, ref } from 'vue';
import { useField } from '@/use/field';
import { useStore } from 'vuex'
import axios from 'axios';

export function useForm(init = []) {
  const store = useStore();

  const submitted = ref(false);
  const loading = ref(false);
  const fields = reactive([]);

  for (let field of init) {
    fields.push(useField(field));
  }

  const valid = computed(() => {
    return fields.every(obj => !obj.errors);
  });

  function reset() {
    loading.value = false;
    fields.map(field => {
      field.touched = false;
      field.disabled = false;
      field.value = '';
    })
  }

  async function submit() {
    if (!valid.value && loading) return;

    loading.value = true;

    fields.map(field => {
      field.disabled = true;
    })

    const data = {};
    for (const field of fields) {
      let value; 
      if (field.name === 'phone') {
        value = field.value.replace(/[^0-9]/g,"");
      } else {
        value = field.value;
      }
      data[field.name] = value;
    }
    data.from = store.state.route.data.title;
    const json = JSON.stringify(data);

    /* await new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, 500);
    })
    submitted.value = true; */

    try {
      await axios.post('/backend/api/application', json, {
        headers: {
          'Content-Type': 'application/json'
        }
      });
      submitted.value = true;
    } catch (error) {
      console.log(error)
    }

    reset();
  }

  return { fields, valid, submitted, loading, submit, reset };
}