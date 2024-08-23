<template>
    <AuthenticatedLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-center mb-8 ">{{ game.name }} Lobby</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="room in rooms" :key="room.id" class="bg-white shadow-md rounded-lg p-6 relative">
                    <h2 class="text-xl font-semibold mb-4">{{ room.player_one?.name }}'s Room</h2>
                    <div class="mb-4">
                        <p class="font-medium">Player One: {{ room.player_one?.name }}</p>
                        <p v-if="room.player_two" class="font-medium">Player Two: {{ room.player_two.name }}</p>
                        <p v-else class="text-gray-500">Waiting for player two...</p>
                    </div>
                    <div class="flex justify-between">
                        <button v-if="!isCurrentUserRoom(room)" @click="joinGame(room)" :disabled="room.player_two"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed">
                            Join Game
                        </button>
                        <button v-else @click="goToGame(room)"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Go to Game
                        </button>
                    </div>
            
                </div>

                <button @click="createGame"
                    class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center justify-center">
                    <h2 class="text-xl font-semibold mb-4">Create New Game</h2>
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps(['game', 'rooms']);
const page = usePage();

const joinGame = (room) => {
    router.post(route('games.room.join', room.id));
};

const goToGame = (room) => {
    router.get(route('games.room.show', room.id));
};

const createGame = () => {
    router.post(route('games.store', props.game.slug));
};

const isCurrentUserRoom = (room) => {
    return room.player_one.id === page.props.auth.user.id;
};
</script>