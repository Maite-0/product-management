<x-layout>
    <h1>Main Page</h1>
    @auth
        <h1>Looged in</h1>
    @endauth
    @guest
        <h1>Guest</h1>
    @endguest
</x-layout>