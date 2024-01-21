<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
<div
    class="bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div id="app" class="max-w-2xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h4 class="text-2xl font-bold dark:text-white">Exchange from USD</h4>
        </div>
        <div>
            <form @submit.prevent="calculate">
                <div class="flex flex-col mb-4">
                    <label class="mb-1 font-semibold" for="amount">To currency</label>
                    <select
                        :class="{'bg-gray-300': isFieldDisabled}"
                        :disabled="isFieldDisabled"
                        v-model="toCurrency"
                        class="w-full p-2 rounded-lg bg-white dark:text-white focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-opacity-50">
                        @foreach($currencies as $currency)
                            <option>{{ $currency->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mb-4">
                    <label class="mb-1 font-semibold" for="amount">Amount</label>
                    <input :disabled="isFieldDisabled" :class="{'bg-gray-300': isFieldDisabled}" type="number" step=".1"
                           v-model="amount" id="amount" name="amount" placeholder="Enter amount"
                           class="w-full p-2 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-opacity-50">
                </div>
                <div v-if="errorMessage">
                    <div class="text-red-800 p-2 rounded">
                        <p>@{{ errorMessage }}</p>
                    </div>
                </div>
                <div v-if="!calculation?.totalAmount" class="mb-2 mt-4">
                    <button :disabled="isFieldDisabled" :class="{'disabled': isFieldDisabled}" type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <span v-if="!calculationLoading">Calculate</span><i v-if="calculationLoading"
                                                                            class="fa fa-spinner"></i>
                    </button>
                </div>
            </form>
            <div>
                <div v-if="calculation?.totalAmount">
                    <h3>Calculation</h3>
                    <p><strong>@{{ calculation.totalAmount }} - @{{ calculation.fromCurrency }}</strong></p>
                    <div v-if="!order" class="mt-4">
                        <button type="button"
                                @click="makeOrder"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                            <span v-if="!orderLoading">“Purchase”</span><i v-if="orderLoading"
                                                                      class="fa fa-spinner"></i>
                        </button>
                        <button type="button"
                                @click="cancel"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                            Cancel
                        </button>
                    </div>
                    <div v-else>
                        <div class="bg-green-800 text-white p-2 rounded mt-4">
                            <p>Sucessfully ordered!</p>
                        </div>
                        <button type="button"
                                @click="orderAgain"
                                class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Order again
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/axios@1.6.5/dist/axios.min.js
"></script>

<script>
    const {createApp, ref, computed} = Vue

    createApp({
        setup() {
            const amount = ref(0)
            const toCurrency = ref('EUR')
            const calculation = ref(null)
            const order = ref(null)
            const calculationLoading = ref(false)
            const orderLoading = ref(false)
            const errorMessage = ref('')

            const isFieldDisabled = computed(() => {
                return calculation.value?.totalAmount || calculationLoading.value
            })

            function calculate() {
                calculation.value = null
                calculationLoading.value = true
                errorMessage.value = ''
                axios.get('/api/currencies/exchange/calculate', {
                    params: {
                        amount: amount.value,
                        fromCurrency: 'USD',
                        toCurrency: toCurrency.value
                    }
                }).then(response => {
                    calculation.value = response.data.data
                    calculationLoading.value = false
                }).catch(error => {
                    errorMessage.value = error.response.data.message
                    calculationLoading.value = false
                })
            }

            function makeOrder() {
                orderLoading.value = true
                axios.post('/api/currencies/exchange/order', {
                    amount: amount.value,
                    fromCurrency: 'USD',
                    toCurrency: toCurrency.value
                }).then(response => {
                    order.value = response.data
                    orderLoading.value = false
                })
            }

            function cancel() {
                calculation.value = null
            }

            function orderAgain() {
                toCurrency.value = null
                amount.value = 0
                order.value = null
                calculation.value = null
            }

            return {
                errorMessage,
                orderAgain,
                isFieldDisabled,
                order,
                makeOrder,
                cancel,
                calculation,
                calculationLoading,
                orderLoading,
                amount,
                toCurrency,
                calculate
            }
        }
    }).mount('#app')
</script>
</body>
</html>
