<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptions') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            @foreach ($subscriptions as $subscription)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subscription->blog->title }}</h5>
                            <p class="card-text">{{ $subscription->blog->description }}</p>
                            <form action="{{ route('subscriptions.destroy', $subscription->blog) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Unsubscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $subscriptions->links() }}
        </div>
    </div>
</x-app-layout>
