<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand>
                <router-link to="/" class="link">WebQuarto </router-link>
            </b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-item >
                        <router-link to="/create" class="link">Adicionar novo </router-link>
                    </b-nav-item>
                    <b-nav-item >
                        <router-link to="/admin" class="link">Painel Administrativo </router-link>
                    </b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
export default {

}
</script>


<style scoped>
    .link{
        color: white;
        text-decoration: none;
    }
</style>
