<template>
  <div>
    <Head title="Dashboard" />
    <div class="py-12 px-10">
      <form action="" class="" @submit.prevent="submit">
        <div class="container">
          <div class="flex flex-col md:flex-col lg:flex-row items-center md:items-end lg:items-end xl:items-end">
            <div class="m-3 w-full md:w-full lg:w-2/6">
              <label for="price" class="block text-md font-medium text-gray-700 my-3">Price</label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 sm:text-sm"> $ </span>
                </div>
                <input type="number"
                  step="any"
                  v-model="form.amount" 
                  name="price" 
                  id="price" 
                  class="focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" 
                  placeholder="0.00">
                <div class="absolute inset-y-0 right-0 flex items-center">
                  <label for="currency" class="sr-only">Currency</label>
                  <select id="currency" name="currency" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                    <option>CAD</option>
                    <option>USD</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="m-3 w-full md:w-full lg:w-5/6">
              <label for="description" class="block text-md font-medium text-gray-700 my-3">Description</label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <input type="text"
                  v-model="form.description" 
                  name="description" 
                  id="description" 
                  class="focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 pl-7 pr-12 sm:text-sm border-gray-300 rounded-md" 
                  placeholder="Enter the description...">
              </div>
            </div>

            <div class="m-3 w-full md:w-full lg:w-1/6 lg: bg-gray-100 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-indigo ml-auto py-3" type="submit">Submit</loading-button>
            </div>
          </div>
        </div>
      </form>

      <!-- transactions -->
      <div class="flex flex-col my-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-auto max-h-80">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700 sticky top-0">
                        <tr>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 sticky top-0">
                                Description
                            </th>
                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400 sticky top-0">
                                Amount
                            </th>
                            <th scope="col" class="p-4">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                      <tr class="hover:bg-gray-100 dark:hover:bg-gray-700" v-for="(transaction,index) in transactions" :key="index">
                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                          {{ transaction.description }}
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                          ${{ transaction.amount }}
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                            <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    LoadingButton,
  },
  props: {
    transactions: Array,
  },
  layout: Layout,
  mounted() {
    console.log(this.transactions);
  },
  data() {
    return {
      form: this.$inertia.form({
        amount: null,
        description: null,
      }),

      transactions_rev: this.transactions,
    }
  },
  methods: {
    submit() {
      // console.log('form', this.form.amount, this.form.description);
      this.form.post('/transaction');
    }
  },

}
</script>
<style scoped>
</style>
