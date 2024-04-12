<template>
	<a-layout>
		<a-layout-header class="header">
			<a-menu
					v-model:selectedKeys="selectedKeys1"
					theme="dark"
					mode="horizontal"
					:style="{ lineHeight: '64px' }">


				<a-menu-item v-if="router.currentRoute.value.name==='users'">
					<router-link to="/" @click="logout" key="1">
						Выход
					</router-link>
				</a-menu-item>

			</a-menu>
		</a-layout-header>
		<a-layout-content style="padding: 0 50px">

			<a-layout style="padding: 24px 0; background: #fff">

				<a-layout-content :style="{ padding: '0 24px', minHeight: '100vh' }">

					<router-view/>

				</a-layout-content>

			</a-layout>
		</a-layout-content>
		<a-layout-footer style="text-align: center">

		</a-layout-footer>
	</a-layout>
</template>


<script setup>
  import {ref, reactive} from 'vue';
  import axios from 'axios'
  import router from './router/router'

  const logout = () => {
    axios.post('/api/logout')
      .then(() => {
        localStorage.removeItem('token');
        router.push('/');
        this.token = false
      })
      .catch((error) => {
        console.log(error);
      });
  }
  const token = ref(false)

  const selectedKeys1 = ref(['1']);
</script>


<style lang="scss" scoped>
	#components-layout-demo-top-side .logo {
		float: left;
		width: 120px;
		height: 31px;
		margin: 16px 24px 16px 0;
		background: rgba(255, 255, 255, 0.3);
	}

	.ant-row-rtl #components-layout-demo-top-side .logo {
		float: right;
		margin: 16px 0 16px 24px;
	}

	.site-layout-background {
		background: #fff;
	}
</style>