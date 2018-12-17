# BarCodes
"Proof of concept" przykładowego zastosowania technologii kodów kreskowych (kodów paskowych, barcodes) do identyfikacji zasobów

## 1. Baza danych
### Generowanie tabel
- Windows
```bash
vendor\bin\doctrine orm:schema-tool:create
```
- Unix
```bash
vendor/bin/doctrine orm:schema-tool:create
```

### Przebudowanie tabel
- Windows
```bash
vendor\bin\doctrine orm:schema-tool:update --force
```
- Unix
```bash
vendor/bin/doctrine orm:schema-tool:update --force
```

### Usuwanie tabel
- Windows
```bash
vendor\bin\doctrine orm:schema-tool:drop --force
```
- Unix
```bash
vendor/bin/doctrine orm:schema-tool:drop --force
```

## 2. Testy jednostkowe
- Windows
```bash
vendor\bin\phpunit tests
```
- Unix
```bash
vendor/bin/phpunit tests
```