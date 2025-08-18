<x-guest-layout>
    <h1 class="text-xl font-bold mb-4">Create your account</h1>

    <form method="POST" action="{{ route('invite.register.store') }}">
        @csrf

        <!-- Prefilled email -->
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ $email }}" readonly class="bg-gray-100">
        </div>

        <!-- Store -->
        <div>
            <label>Store</label>
            <input type="text" name="name" required autofocus>
        </div>

        <!-- Password -->
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <!-- Confirm Password -->
        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <!-- Incentive Tier -->
        <div>
            <select id="incentive-tier">
                <option value="bronze" title="Bronze">Bronze</option>
                <option value="silver" title="Silver">Silver</option>
                <option value="gold" title="Gold">Gold</option>
            </select>
        </div>


        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded" type="submit">
            Sign Up
        </button>
    </form>
</x-guest-layout>
