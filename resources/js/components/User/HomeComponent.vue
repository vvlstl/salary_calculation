<template>
    <div class="container mt-3" v-if="user">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Привет, {{user.name}}</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">На вашем счете доступно: ${{ cash.toFixed(2) }}</li>
                                        <li class="list-group-item">Ваша профессия: {{user.profession.name}}</li>
                                        <li class="list-group-item">Ваша ставка в час ${{salary.toFixed(2)}}</li>
                                    </ul>
                                </div>

                                    <div class="form-group d-flex gap-2 mt-4">
                                        <input v-model="hours" class="form-control" placeholder="Введите количество часов">
                                        <input type="hidden" v-model="user_id">
                                        <button @click.prevent="sendHours" type="submit" class="btn btn-primary">Отправить</button>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Дата</th>
                                <th>Кол-во часов</th>
                                <th>Ставка в час</th>
                                <th>Сумма</th>
                                <th colspan="2">Статус</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(transaction, index) in transactions" :key="index">
                                <td>{{formatDate(transaction.created_at) }}</td>
                                <td>{{transaction.hours }}</td>
                                <td>${{salary.toFixed(2)}}</td>
                                <td>{{transaction.job_cash}}</td>
                                <td>{{getStatusTitle(transaction.status) }}</td>
                                <td><a v-if="transaction.status === 0" @click.prevent="payment(transaction.id)" class="btn badge btn-primary rounded-pill text-decoration-none">Вывод</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import API from "@/api";
import {format} from "date-fns";

export default {
        name: 'HomeComponent',

        data() {
            return {
                user: null,
                cash: null,
                hours: null,
                salary: null,
                job_cash: null,
                user_id: null,
                transactions: null,
                status:null,
                amount_cash:null,
            }
        },

        mounted() {
            this.getUserInfo();
        },

        methods: {
            formatDate(date) {
                return format(new Date(date), "dd.MM.yy HH:mm");
            },
            getUserInfo() {
                API.post('/api/auth/me')
                    .then(res => {
                        this.cash = res.data.amount_cash;
                        this.user = res.data;
                        this.salary = res.data.profession.salary;
                        this.user_id = res.data.id;
                        this.transactions = res.data.transaction;
                    })
            },

            payment(id){
                const transaction = this.transactions.find(transactions => transactions.id === id);
                this.amount_cash = transaction.job_cash + this.cash

                API.patch(`/api/auth/transactions/${id}`, {status: this.status = 1})
                    .then(res => {
                        this.getUserInfo();
                    });
                API.patch(`/api/auth/user/${this.user.id}`, {amount_cash: this.amount_cash})
                    .then(res => {
                        this.getUserInfo();
                    });

            },

            sendHours(){
                this.job_cash = this.hours * this.salary
                API.post('/api/auth/transactions', {
                    hours: this.hours,
                    user_id: this.user_id,
                    job_cash: this.job_cash
                })
                    .then(res => {
                        this.hours = null;
                        this.getUserInfo();
                    })
            },

            getStatusTitle(status) {
                const NOTPAID = 0;
                const PAID = 1;
                const statusMap = {
                    [NOTPAID]: 'Не выплачено',
                    [PAID]: 'Выплачено',
                };
                return statusMap[status];
            },
        },
    }
</script>
