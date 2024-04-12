<template>
	<a-table :columns="columns" :data-source="users" bordered>
		<template #bodyCell="{ column, text, record }">
			<template v-if="['name', 'email'].includes(column.dataIndex)">
				<div>
					<a-input
							v-if="editableData[record.id]"
							v-model:value="editableData[record.id][column.dataIndex]"
							style="margin: -5px 0"
					/>
					<template v-else>
						{{ text }}
					</template>
				</div>
			</template>
			<template v-else-if="column.dataIndex === 'operation'">
				<div class="editable-row-operations">
          <span v-if="editableData[record.id]">
            <a-typography-link @click="save(record.id)">Save</a-typography-link>
            <a-popconfirm title="Sure to cancel?" @confirm="cancel(record.id)">
              <a>Cancel</a>
            </a-popconfirm>
          </span>
					<span v-else>
            <a @click="edit(record.id)" :disabled="record.id===1?'true':null">Edit</a>
            <a @click="del(record.id)" :disabled="record.id===1?'true':null">Delete</a>
          </span>

				</div>
			</template>
		</template>
	</a-table>
</template>
<script setup>
  import {cloneDeep} from 'lodash-es';
  import {reactive, ref, defineProps, computed} from 'vue';
  import axios from 'axios'

  const props = defineProps([
      'columns',
      'users'
    ]
  )

  const dataSource = ref(props.users);
  const editableData = reactive({});

  const edit = key => {
    if (key === 1) return
    editableData[key] = cloneDeep(dataSource.value.filter(
      item => key === item.id)[0]
    );
  };

  const save = async key => {
    Object.assign(dataSource.value.filter(item =>key === item.id)[0], editableData[key]);
    await axios.patch(`/api/users/${key}`, editableData[key])
    delete editableData[key];
  };

  const del = async key => {
    if (key) return
    Object.assign(dataSource.value, dataSource.value.filter(item =>item.id !== key));
    await axios.delete(`/api/users/${key}`)
  };

  const cancel = key => {
    delete editableData[key];
  };
</script>

<style scoped>
	.editable-row-operations a {
		margin-right: 8px;
	}
</style>