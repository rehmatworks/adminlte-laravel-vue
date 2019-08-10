<template>
<div>
    <section class="content-header">
        <h1>
            Website Settings
            <small>Manage website settings</small>
        </h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title text-primary">General Settings</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.app_name}">
                            <label>Website Name</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.app_name" placeholder="Website name...">
                            <span class="help-block" v-if="errors.app_name">{{ errors.app_name[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.allow_signups}">
                            <label>Allow User Signups</label>
                            <select class="form-control" v-model="settings.allow_signups">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                            <span class="help-block" v-if="errors.allow_signups">{{ errors.allow_signups[0] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title text-primary">Mail Settings</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_driver}">
                            <label>Mail Driver</label>
                            <select class="form-control" v-model="settings.mail_driver">
                                <option value="smtp">SMTP</option>
                                <option value="mailgun">Mailgun</option>
                                <option value="sendmail">Mail</option>
                            </select>
                            <span class="help-block" v-if="errors.mail_driver">{{ errors.mail_driver[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'smtp'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_host}">
                            <label>SMTP Host</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mail_host" placeholder="SMTP host...">
                            <span class="help-block" v-if="errors.mail_host">{{ errors.mail_host[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'smtp'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_username}">
                            <label>SMTP Username</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mail_username" placeholder="SMTP username...">
                            <span class="help-block" v-if="errors.mail_username">{{ errors.mail_username[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'smtp'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_password}">
                            <label>SMTP Password</label>
                            <input @keyup.enter="updateSettings()" type="password" class="form-control" v-model="settings.mail_password" placeholder="SMTP password...">
                            <span class="help-block" v-if="errors.mail_password">{{ errors.mail_password[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'smtp'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_port}">
                            <label>SMTP Port</label>
                            <input @keyup.enter="updateSettings()" type="number" class="form-control" v-model="settings.mail_port" placeholder="SMTP port...">
                            <span class="help-block" v-if="errors.mail_port">{{ errors.mail_port[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'smtp'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_encryption}">
                            <label>SMTP Encryption</label>
                            <select class="form-control" v-model="settings.mail_encryption">
                                <option value="tls">TLS</option>
                                <option value="ssl">SSL</option>
                                <option value="">None</option>
                            </select>
                            <span class="help-block" v-if="errors.mail_encryption">{{ errors.mail_encryption[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'mailgun'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mailgun_domain}">
                            <label>Mailgun Domain</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mailgun_domain" placeholder="Mailgun domain...">
                            <span class="help-block" v-if="errors.mailgun_domain">{{ errors.mailgun_domain[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'mailgun'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mailgun_secret}">
                            <label>Mailgun Secret</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mailgun_secret" placeholder="Mailgun secret...">
                            <span class="help-block" v-if="errors.mailgun_secret">{{ errors.mailgun_secret[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="settings.mail_driver == 'mailgun'">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mailgun_endpoint}">
                            <label>Mailgun Endpoint</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mailgun_endpoint" placeholder="Mailgun endpoint...">
                            <span class="help-block" v-if="errors.mailgun_endpoint">{{ errors.mailgun_endpoint[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_from_email}">
                            <label>From Email</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mail_from_email" placeholder="Default from email...">
                            <span class="help-block" v-if="errors.mail_from_email">{{ errors.mail_from_email[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" :class="{'has-error': errors.mail_from_name}">
                            <label>From Name</label>
                            <input @keyup.enter="updateSettings()" type="text" class="form-control" v-model="settings.mail_from_name" placeholder="Default from name...">
                            <span class="help-block" v-if="errors.mail_from_name">{{ errors.mail_from_name[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button :disabled="loading" @click="updateSettings()" class="btn btn-primary">Update Settings</button>
                    </div>
                </div>
            </div>
            <div v-if="loading" class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </section>
</div>
</template>

<script>
export default {
    data() {
        return {
            errors: []
        }
    },
    mounted() {
        this.getSettings();
    },
    methods: {
        updateSettings() {
            let _this = this;
            _this.loading = true;
            _this.errors = [];
            axios.post(`${baseUrl}/api/settings`, _this.settings).then((res) => {
                _this.showToast('Settings have been updated', 'success');
                _this.loading = false;
                _this.getSettings();
            }).catch((err) => {
                _this.showToast('Settings cannot be updated', 'error');
                _this.loading = false;
            });
        },
        getSettings() {
            let _this = this;
            _this.loading = true;
            axios.get(`${baseUrl}/api/settings`).then((res) => {
                _this.settings = res.data;
                _this.loading = false;
            });
        }
    }
}
</script>
