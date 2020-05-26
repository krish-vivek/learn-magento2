<?php

namespace Mage2tv\BrandExample\Setup;


class StoreRoutinesProvider
{
	private static $createStoredFunctionsSql = [
		"DROP FUNCTION IF EXISTS UCWORD",
		"CREATE FUNCTION UCWORD(word VARCHAR(255)) RETURNS VARCHAR(255) DETERMINISTIC
			RETURN CONCAT(UPPER(SUBSTR(word, 1, 1)), LOWER(SUBSTR(word, 2)))",

		"DROP FUNCTION IF EXISTS FIRST_WORD",
		"CREATE FUNCTION FIRST_WORD(sentence TEXT) RETURNS VARCHAR(255) DETERMINISTIC
			RETURN TRIM(SUBSTRING_INDEX(sentence, ' ', 1))",


		"DROP FUNCTION IF EXISTS UFIRST_WORD",
		"CREATE FUNCTION UFIRST_WORD(sentence TEXT) RETURNS VARCHAR(255) DETERMINISTIC
			RETURN UCWORD(FIRST_WORD(sentence))",


		"DROP FUNCTION IF EXISTS BUT_FIRST_WORD",
		"CREATE FUNCTION BUT_FIRST_WORD(sentence TEXT) RETURNS TEXT DETERMINISTIC
			RETURN TRIM(SUBSTR(sentence, LENGTH(first_word(sentence)) + 1))",

		"DROP FUNCTION IF EXISTS UCWORDS",
		"CREATE FUNCTION UCWORDS(sentence TEXT) RETURNS VARCHAR(255) DETERMINISTIC

	BEGIN
		DECLARE result TEXT DEFAULT UFIRST_WORD(sentence);
		SET sentence =  BUT_FIRST_WORD(sentence);
		WHILE sentence <> '' DO
			SET result =  CONCAT(result, ' ', UFIRST_WORD(sentence));
			SET sentence = BUT_FIRST_WORD(sentence);
		END WHILE;
		RETURN result;
		END",
	];

	/**
	 * return string[]
	 */
	public function getStoredFunctionSql():array
	{
		return self::$createStoredFunctionsSql;
	}
}