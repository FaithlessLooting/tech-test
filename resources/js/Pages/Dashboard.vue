<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    is_admin: {
        type: Boolean,
    },
    name: {
        type: String,
    },
    incentive_current: {
        type: Number
    },
    incentive_tier: {
        type: String
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>

         <!-- Admin Invite Form -->
    <div v-if="is_admin" class="mt-6 p-4 border rounded bg-gray-50">
      <h2 class="text-xl font-semibold mb-2">Send Invite</h2>

      <form @prevent.submit="sendInvite">
        <input
          type="email"
          v-model="email"
          id="email" 
          placeholder="Enter email"
          required
          class="border p-2 rounded w-full"
        />
        <button
          type="submit"
          class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
        >
          Send Invite
        </button>
      </form>

      <p v-if="statusMessage" class="text-green-600 mt-2">{{ statusMessage }}</p>
    </div>
        <!-- Non-Admin Users -->
        <div v-else class="mt-6 p-4 border rounded bg-gray-50">
        <h2> Welcome, {{name}}</h2>
        <p>You are currently {{incentive_current}} Sales towards your target.</p>
        <p>You are currently on a {{incentive_tier}} plan </p>
        </div>
    </AuthenticatedLayout>


</template>


<script>
import { ref } from 'vue';

export default {
  props: {
    is_admin: {
      type: Boolean,
      default: () => null, // safe fallback
    },
    status: {
      type: String,
      default: '',
    },
  },
  setup(props) {
    const email = ref('');
    const statusMessage = ref(props.status || '');

    const sendInvite = () => {
      if (!props.is_admin) return;

      Inertia.post(
        '/invite/send',
        { email: email.value },
        {
          onSuccess: (page) => {
            statusMessage.value = page.props.status || 'Invite sent';
            email.value = '';
          },
          onError: (errors) => {
            statusMessage.value = errors.email || 'Error sending invite';
          },
        }
      );
    };

    // Must return props and refs to template
    return {
      email,
      statusMessage,
      sendInvite,
      user: props.user,
    };
  },
};
</script>
