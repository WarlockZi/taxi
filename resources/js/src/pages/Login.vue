<template>
	<a-form
			:model="formState"
			name="normal_login"
			class="login-form"
	>
		<a-form-item
				label="Username"
				name="name"
				:rules="[{ required: true, message: 'Please input your username!' }]"
		>
			<a-input v-model:value="formState.name">
				<template #prefix>
					<UserOutlined class="site-form-item-icon"/>
				</template>
			</a-input>
		</a-form-item>

		<a-form-item
				label="Password"
				name="password"
				:rules="[{ required: true, message: 'Please input your password!' }]"
		>
			<a-input-password v-model:value="formState.password">
				<template #prefix>
					<LockOutlined class="site-form-item-icon"/>
				</template>
			</a-input-password>
		</a-form-item>


		<a-form-item>
			<a-button @click.prevent="login" :disabled="disabled" type="primary" html-type="submit" class="login-form-button">
				Войти
			</a-button>
		</a-form-item>
	</a-form>
</template>


<script setup>
  import {reactive, computed} from 'vue';
  import axios from 'axios';
  import {useRouter} from 'vue-router'

  const router = useRouter()

  const login = () => {
    axios.defaults.withCredentials = true;
    axios.post(
      'http://testtasklaravelvue/api/login',
      {
        name: formState.name,
        password: formState.password
      }
    )
      .then(({data}) => {
        localStorage.setItem('token', data.access_token);
        localStorage.setItem('user', JSON.stringify(data.user));
        router.push({path: '/users'})
      })
      .catch((error) => {
        console.log(error);
        if (error.response && error.response.status === 422) {
          const responseData = error.response.data;
          this.errors = {};
          for (const field in responseData.errors) {
            if (Object.prototype.hasOwnProperty.call(responseData.errors, field)) {
              this.errors[field] = responseData.errors[field][0];
            }
          }
        }
      });

  }

  const formState = reactive({
    name: 'Admin',
    password: 'admin',
  });

  const disabled = computed(() => {
    return !(formState.name && formState.password);
  });

</script>


<style scoped>
	#components-form-demo-normal-login .login-form {
		max-width: 300px;
	}

	#components-form-demo-normal-login .login-form-forgot {
		float: right;
	}

	#components-form-demo-normal-login .login-form-button {
		width: 100%;
	}
</style>