# run commands

- Listen to events: `go run receive_logs_topic.go "#"`

- Trigger the event: `go run emit_logs_topic.go "kern.critical" "A critical kernel error"`