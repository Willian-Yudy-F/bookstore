from pathlib import Path
import re
import unittest


ROOT = Path(__file__).resolve().parents[1]


class RepositoryTests(unittest.TestCase):
    def test_database_dump_contains_no_user_records(self) -> None:
        sql = (ROOT / "advanced_web.sql").read_text(encoding="utf-8")
        self.assertNotRegex(sql, r"INSERT INTO `users`")
        self.assertNotRegex(sql, r"INSERT INTO `reviews`")
        self.assertNotRegex(sql, r"INSERT INTO `favorites`")
        self.assertNotRegex(sql, r"[\w.+-]+@[\w.-]+\.[A-Za-z]{2,}")

    def test_database_credentials_are_environment_based(self) -> None:
        source = (ROOT / "db.php").read_text(encoding="utf-8")
        for variable in ("DB_HOST", "DB_USER", "DB_PASSWORD", "DB_NAME"):
            self.assertIn(f"getenv('{variable}')", source)
        self.assertNotIn("infinityfree", source.lower())

    def test_sensitive_forms_use_csrf_tokens(self) -> None:
        form_pages = (
            "login.php",
            "register.php",
            "book.php",
            "favorites.php",
            "account.php",
            "toggle_favorite.php",
            "logout.php",
        )
        for filename in form_pages:
            with self.subTest(filename=filename):
                source = (ROOT / filename).read_text(encoding="utf-8")
                self.assertTrue(
                    "csrf_input()" in source or "require_valid_csrf()" in source
                )

    def test_obsolete_duplicate_tree_is_removed(self) -> None:
        self.assertFalse((ROOT / "advweb").exists())
        self.assertFalse((ROOT / "teste.php").exists())
        self.assertFalse((ROOT / "users.sql").exists())

    def test_readme_does_not_advertise_dead_demo(self) -> None:
        readme = (ROOT / "README.md").read_text(encoding="utf-8")
        self.assertIn("no longer available", readme)
        self.assertNotIn("## Live Demo", readme)


if __name__ == "__main__":
    unittest.main()
