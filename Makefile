.DEFAULT_GOAL=up

init:
	./vendor/bin/sail up -d
	composer i
	pnpm i
	./vendor/bin/sail php artisan migrate
	./vendor/bin/sail php artisan db:seed
	pnpm run dev

up:
	./vendor/bin/sail up -d
	pnpm run dev

down:
	./vendor/bin/sail down
