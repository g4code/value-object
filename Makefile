TITLE = [path-object]

unit-tests:
	@/bin/echo -e "${TITLE} unit test suite started..." \
	&& ./vendor/bin/phpunit -c tests/unit/phpunit.xml --coverage-html tests/unit/coverage

.PHONY: unit-tests