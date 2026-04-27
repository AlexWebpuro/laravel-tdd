<x-layouts::app :title="__('Repositorios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Url</th>
                        <th>Enlace</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($repositories as $repository)
                        <tr>
                            <th class="border px-4 py-2">{{ $repository->id }}</th>
                            <th class="border px-4 py-2">{{ $repository->url }}</th>
                        </tr>
                    @empty
                        <tr>
                            <th>No hay repositorios creados</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts::app>
