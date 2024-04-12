<template>

	<UsersTableEditable
			:users="users"
			:columns="columns"
	/>

</template>

<script>
  import UsersTableEditable from '../components/UsersTableEditable.vue'
  import axios from 'axios'

  export default {
    components: {UsersTableEditable},
    data() {
      return {
        users: [],
        columns: [],
      }
    },
    created() {

      this.fetchData()
        .then(this.setColumns())
    },
    methods: {
      setColumns() {
        this.columns = [
          {
            title: 'name',
            dataIndex: 'name',
            width: '30%',
            scopedSlots: {customRender: 'name'},
          },
          {
            title: 'email',
            dataIndex: 'email',
          },
          {
            title: 'operation',
            dataIndex: 'operation',
            scopedSlots: {customRender: 'operation'},
          },
        ];
      },
      async fetchData() {
        try {
          const res = await axios.get('/api/users')
          this.users = res.data
        } catch (e) {
          return e
        }
      }
    },

  }
</script>

<style scoped>

</style>