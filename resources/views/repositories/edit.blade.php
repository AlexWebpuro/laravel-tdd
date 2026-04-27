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
            <form action={{ route('repositories.update', $repository) }} method="POST" class="max-w-mg">
                @csrf
                @method('PUT')

                <label for="" class="block font-medium text-sm text-gray-700">URL *</label>
                <input class="form-input w-full rounded-md shadow-sm" type="text" name="url" id={{ $repository->url }} value="{{ $repository->url }}">

                <label for="" class="block font-medium text-sm text-gray-700">Description *</label>
                <textarea class="form-input w-full rounded-md shadow-sm" type="text" name="description" id={{ $repository->id }} >
                    {{ $repository->description }}
                </textarea>

                <hr class="my-4">

                <input type="submit" value="Editar" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
            </form>
        </div>
    </div>
</x-layouts::app>